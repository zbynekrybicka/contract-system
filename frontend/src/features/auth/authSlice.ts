import { createSlice } from '@reduxjs/toolkit';
const saved = localStorage.getItem('token');

const slice = createSlice({
  name: 'auth',
  initialState: { token: saved as string | null },
  reducers: {
    setToken: (s, a) => { s.token = a.payload; localStorage.setItem('token', a.payload); },
    logout: (s) => { s.token = null; localStorage.removeItem('token'); }
  }
});
export const { setToken, logout } = slice.actions;
export default slice.reducer;
