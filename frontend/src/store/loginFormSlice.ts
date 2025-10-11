import { createSlice } from '@reduxjs/toolkit';
import type { Action, RootState } from '.';

export type LoginFormData = {
  email: string;
  password: string;
}

const slice = createSlice({
    name: "loginForm",

    initialState: { 
        email: "",
        password: ""
    },

    reducers: {

        /**
         * Set email in login form
         * 
         * @param state LoginFormData
         * @param action Action
         */
        setEmail: (state: LoginFormData, action: Action<string>) => {
            state.email = action.payload
        },
        
        /**
         * Set password in login form
         * 
         * @param state LoginFormData
         * @param action Action
         */
        setPassword: (state: LoginFormData, action: Action<string>) => {
            state.password = action.payload
        }
    }
})

/**
 * Email value from login form
 * 
 * @param state 
 * @returns string
 */
export const getEmail = (state: RootState): string => state.loginForm.email ?? ""

/**
 * Password value from login form
 * 
 * @param state RootState
 * @returns string
 */
export const getPassword = (state: RootState): string => state.loginForm.password ?? ""


export default slice.reducer
export const { setEmail, setPassword } = slice.actions