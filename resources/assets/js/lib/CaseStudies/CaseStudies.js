import axios from "axios"

function fetchCaseStudy(id) {
    return new Promise((resolve, reject) => {
        axios.get(`/admin/case-studies/${id}`)
            .then(({data}) => resolve(data))
            .catch(resp => reject(resp.data));
    });
}