---
name: extension-init
description: >
  Creates a JS extension skeleton.
  Use when a new JS extension needs to be created from scratch.
argument-hint: "[namespace] [description]"
allowed-tools: Bash Glob Read Write
---

Create a JS extension skeleton. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/module/example-extension/` — they define the exact file style and structure.

## Clarify before generating (if not provided in arguments)

1. **Namespace** — path in the BX namespace, e.g. `Vendor.Module.Feature`
2. **Description** — what the extension does, one line

Ask for everything needed before generating.

## Generation rules

### Derive from namespace:

- **Extension directory**: segments after the first, in kebab-case, joined by `/`,
  e.g. `Vendor.Module.Feature` → `module/feature/`
- **Main JS class name**: last namespace segment, e.g. `Feature`
- **namespace in bundle.config.js**: prepend `BX.`, e.g. `BX.Vendor.Module`
  (without the last segment — it is exported inside index.js)
- **Keys in lang/ru/config.php**: all segments in UPPER_SNAKE_CASE

### File structure

```
{module}/{extension-name}/
├── config.php
├── bundle.config.js
├── lang/
│   └── ru/
│       └── config.php
└── src/
    ├── index.js
    ├── {ClassName}.js
    └── style.css
```

### config.php

- `js` and `css` always point to `dist/bundle.js` and `dist/bundle.css`
- `rel` — dependencies on other extensions (at minimum `main.core`)
- `lang` — always `'lang/' . LANGUAGE_ID . '/config.php'`

### bundle.config.js

- `input` always `'src/index.js'`
- `output` — string `'dist/bundle.js'` (if CSS is present — object with `js` and `css`)
- `namespace` — `BX.Vendor.{...}` (parent namespace, without the class name)
- `minification` always `false`

### src/index.js

- Imports the main class from `./{ClassName}`
- Calls `BX.namespace(...)` with the full namespace (without the class name)
- Wraps initialization in `BX.ready()`
- Checks `hasOwnProperty` before assigning
- Calls `{ClassName}.create()` to initialize

### src/{ClassName}.js

- ES6 class with `constructor(props = {})`
- `init()` method for initialization logic
- Constructor calls `this.init()`
- Static method `static create(props = {}) { return new this(props); }`
- If AJAX requests are needed — `runAction(action, data = {})` method via `BX.ajax.runAction`

### src/style.css

- Empty file or minimal styles with classes based on the extension name

### lang/ru/config.php

- Empty file with a placeholder comment if lang keys are not known in advance

## Where to save

Find the JS extensions directory via Glob (`**/local/js/`) and create the extension folder inside it.

## After generation

Print the file tree of created files and the full path to the extension root.
