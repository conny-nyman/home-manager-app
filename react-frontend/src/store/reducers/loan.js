import * as actionTypes from './actions';

const initialState = {
    loans: []
};

const reducer = (state = initialState, action) => {

    let updatedLoans = [];

    switch (action.type) {
        case actionTypes.ADD_LOAN:
            updatedLoans = state.loans.splice('');
            updatedLoans.push(action.loan);
            return {
                ...state,
                loans: updatedLoans
            };
        case actionTypes.REMOVE_LOAN:
            updatedLoans = state.loans.filter((loan) => loan.id !== action.id);
            return {
                ...state,
                loans: updatedLoans
            };
        default:
            return state
    }
};

export default reducer;
