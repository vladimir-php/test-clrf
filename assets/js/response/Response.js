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
     * @returns {false|(function(): *)|Event|*}
     */
    success() {
        return this.data().success;
    }

    /**
     *
     * @returns {*}
     */
    rawData() {
        return this.response;
    }

    /**
     *
     * @returns {*}
     */
    data() {
        return this.response.data ?? [];
    }

    /**
     *
     * @returns {*}
     */
    errors() {
        return this.response.data.errors ?? this.response.data;
    }

}
