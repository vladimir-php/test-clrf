/**
 *
 */
export default class Request {

    /**
     *
     * @param method
     * @param uri
     * @param data
     * @param token
     */
    constructor({
        method,
        uri,
        data = []
    }) {
        this.method = method;
        this.uri = uri;
        this.data = data;
    }

}
