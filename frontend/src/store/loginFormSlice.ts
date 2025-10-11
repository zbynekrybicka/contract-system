import { createSlice } from '@reduxjs/toolkit';
import type { RootState } from '.';

const slice = createSlice({
    name: "loginForm",
    initialState: { 
        email: "",
        password: ""
    },

    reducers: {
        setEmail: (s, a) => {
            s.email = a.payload as string
        },
        setPassword: (s, a) => {
            s.password = a.payload as string
        }
    }
})

export default slice.reducer

export const { setEmail, setPassword } = slice.actions
export const getEmail = (s: RootState): string => s.loginForm.email ?? ""
export const getPassword = (s: RootState): string => s.loginForm.password ?? ""