import Response from "../response/Response";
import axios from "axios";

/**
 *
 */
export default class Query {

    /**
     *
     */
    constructor() {

    }

    /**
     *
     * @param request
     * @returns {Promise<void>}
     */
    async queryRequest(request) {
        return this.query({
            method: request.method,
            url: request.uri,
            data: request.data,
        });
    }

    /**
     *
     * @param method
     * @param url
     * @param data
     * @param headers
     * @returns {Promise<Response>}
     */
    async query({
        method,
        url,
        data = {},
        headers = {}
    }) {

        let response;
        try {
            const axiosArgs = {
                method,
                url,
                headers
            };
            if (method === 'get') {
                axiosArgs.params = data;
            }
            else {
                axiosArgs.data = data;
            }
            response = await axios(axiosArgs);
        }
        catch(e) {
            response = e.response.data;
        }

        return new Response(response);
    }


}
