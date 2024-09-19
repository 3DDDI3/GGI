import {
    ERROR_DISPLAY_ON,
    ERROR_DISPLAY_OFF,
    LOADER_DISPLAY_ON,
    LOADER_DISPLAY_OFF,
} from "./types";



export function loaderOn() {
    return {
        type: LOADER_DISPLAY_ON
    }
}
export function loaderOff() {
    return {
        type: LOADER_DISPLAY_OFF
    }
}

export function errorOn(text) {
    return dispatch => {
        dispatch({
            type: ERROR_DISPLAY_ON,
            text
        });

        setTimeout(() => {
            dispatch(errorOff());
        }, 2000)
    }
}
export function errorOff() {
    return {
        type: ERROR_DISPLAY_OFF,
    }
}


