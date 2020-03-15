import * as types from './mutations-type';

const mutations = {
    [types.setRoleID](state: any, role_id: number) {
        state.role_id = role_id;
    },
    [types.setRoleName](state: any, role_name: string) {
        state.role_name = role_name;
    },
    [types.setAvator](state: any, avator: string) {
        state.avator = avator;
    },
    [types.setEmail](state: any, email: string) {
        state.email = email;
    },
    [types.setName](state: any, name: string) {
        state.name = name;
    },
    [types.setPosition](state: any, position: string) {
        state.position = position;
    }
}
export default mutations;