import "./style.css";

export default class ExampleExtension {
    constructor(props = {}) {
        this.props = props;

        this.init();
    }

    async init() {
        // TODO: initialization logic
        this.addCustomEvents();
    }

    addCustomEvents() {

    }

    async getData() {
        return BX.ajax.runAction('vendor:module.api.Controller.getData', {
            data: {}
        }).then(
            response => Promise.resolve(response.data),
            e => Promise.reject(e.errors[0]));
    }

    static create(props = {}) {
        return new this(props);
    }
}
