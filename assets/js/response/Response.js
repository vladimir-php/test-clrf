/**
 *
 */
export default class Response {

    /**
     *
     * @param response
     */
    constructor(response) {
        this.response = response;
    }

    /**
     *
     * @returns {*}
     */
    rawData() {
        return this.response.data;
    }

    /**
     *
     * @returns {false|(function(): *)|Event|*}
     */
    success() {
        return this.rawData().success;
    }

    /**
     *
     * @returns {*}
     */
    data() {
        return this.rawData().data ?? [];
    }

    /**
     *
     * @returns {*}
     */
    errors() {
        return this.rawData().errors ?? this.rawData();
    }

}
