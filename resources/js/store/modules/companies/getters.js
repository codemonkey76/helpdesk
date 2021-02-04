export default {
    companies: state => {
        return state.companies;
    },
    companiesByOrganization: state => id => {
        return state.companies.filter(company => company.organization_id === +id);
    },
};
