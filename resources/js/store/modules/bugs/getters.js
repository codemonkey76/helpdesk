export default {
    bugs: state => {
        return state.bugs
    },
    openBugs: state => {
        return state.bugs.filter(x => x.open == true)
    },
    closedBugs: state => {
        return state.bugs.filter(x => x.open != true)
    }
};