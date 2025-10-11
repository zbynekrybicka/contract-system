import { createSlice } from '@reduxjs/toolkit';
import type { Action, RootState } from '.';

const token = localStorage.getItem('token') as string | null;

type AuthState = {
  token: string | null
}

const slice = createSlice({
  name: 'auth',

  initialState: { token },

  reducers: {

    /**
     * Set authorization token for access to information system
     * 
     * @param state AuthState
     * @param action Action<string>
     */
    setToken: (state: AuthState, action: Action<string>) => { 
      state.token = action.payload
      localStorage.setItem('token', action.payload)
    },

    /**
     * Erase authorization token for logout
     * 
     * @param state AuthState
     */
    logout: (state: AuthState) => { 
      state.token = null
      localStorage.removeItem('token')
    }
  }
})
/**
 * AuthToken for check if you are logged in
 * 
 * @param state RootState
 * @returns string
 */
export const getAuthToken = (state: RootState): string => state.auth.token ?? ""

export default slice.reducer
export const { setToken, logout } = slice.actions
