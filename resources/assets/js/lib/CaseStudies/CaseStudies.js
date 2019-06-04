import axios from "axios"

function fetchCaseStudy(id) {
    return new Promise((resolve, reject) => {
        axios.get(`/admin/case-studies/${id}`)
            .then(({data}) => resolve(data))
            .catch(resp => reject(resp.data));
    });
}

function saveCaseStudy(study) {
    return new Promise((resolve, reject) => {
        axios.post(`/admin/case-studies/${study.id}`, study)
             .then(({data}) => resolve(data))
             .catch(resp => reject(resp.data));
    });
}

function publishCaseStudy(id) {
    return new Promise((resolve, reject) => {
        axios.post("/admin/published-case-studies", {case_study_id: id})
             .then(({data}) => resolve(data))
             .catch(resp => reject(resp.data));
    });
}

function retractCaseStudy(id) {
    return new Promise((resolve, reject) => {
        axios.delete(`/admin/published-case-studies/${id}`)
             .then(({data}) => resolve(data))
             .catch(resp => reject(resp.data));
    });
}

export {fetchCaseStudy, saveCaseStudy, publishCaseStudy, retractCaseStudy};