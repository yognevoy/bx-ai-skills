<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Vendor\Module\Service\ExampleService;

Loc::loadMessages(__FILE__);

class CBPExampleActivity extends CBPActivity
{
    public const ACTION_TYPE_CREATE = 'CREATE';
    public const ACTION_TYPE_UPDATE = 'UPDATE';
    public const ACTION_TYPE_DELETE = 'DELETE';

    public function __construct($name)
    {
        parent::__construct($name);

        $this->arProperties = [
            'recordId' => '',
            'actionType' => self::ACTION_TYPE_CREATE,
            'notifyResponsible' => 'N',
        ];
    }

    public function Execute()
    {
        $recordId = (int)$this->recordId;
        $actionType = $this->actionType;
        $notify = $this->notifyResponsible === 'Y';

        try {
            ExampleService::process($recordId, $actionType, $notify);
        } catch (Throwable $e) {
            $this->writeToTrackingService(
                Loc::getMessage('BPEA_ACTIVITY_RESULT_ERROR', [
                    '#ERROR_MESSAGE#' => $e->getMessage() . '; ' . $e->getFile() . '; ' . $e->getLine(),
                ]),
                0,
                CBPTrackingType::Error
            );

            return CBPActivityExecutionStatus::Faulting;
        }

        $this->writeToTrackingService(
            Loc::getMessage('BPEA_ACTIVITY_RESULT_SUCCESS', [
                '#RECORD_ID#' => $recordId,
                '#ACTION_TYPE#' => $actionType,
            ])
        );

        return CBPActivityExecutionStatus::Closed;
    }

    public static function ValidateProperties($arTestProperties = [], CBPWorkflowTemplateUser $user = null)
    {
        $arErrors = [];

        if (empty($arTestProperties['recordId'])) {
            $arErrors[] = [
                'code' => 'emptyDescription',
                'message' => Loc::getMessage('BPEA_EMPTY_RECORD_ID'),
            ];
        }

        if (empty($arTestProperties['actionType'])) {
            $arErrors[] = [
                'code' => 'emptyDescription',
                'message' => Loc::getMessage('BPEA_EMPTY_ACTION_TYPE'),
            ];
        }

        return array_merge($arErrors, parent::ValidateProperties($arTestProperties, $user));
    }

    public static function GetPropertiesDialog(
        $documentType,
        $activityName,
        $arWorkflowTemplate,
        $arWorkflowParameters,
        $arWorkflowVariables,
        $arCurrentValues = null,
        $formName = ''
    )
    {
        $dialog = new \Bitrix\Bizproc\Activity\PropertiesDialog(__FILE__, [
            'documentType' => $documentType,
            'activityName' => $activityName,
            'workflowTemplate' => $arWorkflowTemplate,
            'workflowParameters' => $arWorkflowParameters,
            'workflowVariables' => $arWorkflowVariables,
            'currentValues' => $arCurrentValues,
            'formName' => $formName,
            'siteId' => '',
        ]);

        $dialog->setMap(static::getPropertiesMap($documentType));

        return $dialog;
    }

    public static function GetPropertiesDialogValues(
        $documentType,
        $activityName,
        &$arWorkflowTemplate,
        &$arWorkflowParameters,
        &$arWorkflowVariables,
        $arCurrentValues,
        &$errors
    )
    {
        $errors = [];
        $properties = [];

        foreach (static::getPropertiesMap($documentType) as $id => $property) {
            $properties[$id] = $arCurrentValues[$property['FieldName'] ?? ''];
        }

        $errors = self::ValidateProperties(
            $properties,
            new CBPWorkflowTemplateUser(CBPWorkflowTemplateUser::CurrentUser)
        );

        if (count($errors) > 0) {
            return false;
        }

        $currentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
        $currentActivity['Properties'] = $properties;

        return true;
    }

    protected static function getPropertiesMap(array $documentType, array $context = []): array
    {
        return [
            'recordId' => [
                'Name' => Loc::getMessage('BPEA_PD_RECORD_ID'),
                'FieldName' => 'record_id',
                'Type' => 'string',
                'Required' => true,
                'Default' => '',
            ],
            'actionType' => [
                'Name' => Loc::getMessage('BPEA_PD_ACTION_TYPE'),
                'FieldName' => 'action_type',
                'Type' => 'select',
                'Required' => true,
                'Multiple' => false,
                'Options' => static::getActionTypes(),
                'Default' => self::ACTION_TYPE_CREATE,
            ],
            'notifyResponsible' => [
                'Name' => Loc::getMessage('BPEA_PD_NOTIFY_RESPONSIBLE'),
                'FieldName' => 'notify_responsible',
                'Type' => 'bool',
                'Default' => 'N',
            ],
        ];
    }

    protected static function getActionTypes(): array
    {
        return [
            self::ACTION_TYPE_CREATE => Loc::getMessage('BPEA_ACTION_TYPE_CREATE'),
            self::ACTION_TYPE_UPDATE => Loc::getMessage('BPEA_ACTION_TYPE_UPDATE'),
            self::ACTION_TYPE_DELETE => Loc::getMessage('BPEA_ACTION_TYPE_DELETE'),
        ];
    }
}
