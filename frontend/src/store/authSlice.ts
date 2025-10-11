import { createSlice } from '@reduxjs/toolkit';
import type { RootState } from '.';

const saved = localStorage.getItem('token');

const slice = createSlice({
  name: 'auth',

  initialState: { token: saved as string | null },

  reducers: {
    setToken: (s, a) => { 
      s.token = a.payload; 
      localStorage.setItem('token', a.payload); 
    },
    logout: (s) => { 
      s.token = null; 
      localStorage.removeItem('token'); 
    }
  }
});
export default slice.reducer;

export const { setToken, logout } = slice.actions;
export const getAuthToken = (s: RootState): string => s.auth.token ?? ""