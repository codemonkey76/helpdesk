import Vue from 'vue';

export default {
    SET_BUGS(state, payload) {
        state.bugs = payload;
    },
    CLOSE_BUG(state, id) {
        let index = state.bugs.findIndex(bug => bug.id === id);
        if (index < 0) {
            console.error('Could not find bug.');
            return;
        }
        state.bugs[index].open = false;
    },
    OPEN_BUG(state, id) {
        let index = state.bugs.findIndex(bug => bug.id === id);
        if (index < 0) {
            console.error('Could not find bug.');
            return;
        }
        state.bugs[index].open = true;
    },
    REPORT_BUG(state, bug) {
        bug.created_at = new Date().toISOString();
        bug.updated_at = new Date().toISOString();
        bug.open = true;
        bug.id = -1;
        
        state.bugs.push(bug);
    },
    UPDATE_BUG(state, bug) {
        let index = state.bugs.findIndex(bug => bug.id === -1)
        
        if (index < 0) {
            console.error('Could not find bug.');
            return;
        }
        Vue.set(state.bugs, index, bug);
        //state.bugs[index] = bug;
    }
};