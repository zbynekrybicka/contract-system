import { configureStore } from '@reduxjs/toolkit';
import authReducer from './authSlice';
import loginFormReducer from './loginFormSlice'
import { api } from '../services/api';

export const store = configureStore({
  reducer: { 
    /**
     * Here register new reducers
     */
    auth: authReducer,
    loginForm: loginFormReducer,

    [api.reducerPath]: api.reducer 
  },
  middleware: (gDM) => gDM().concat(api.middleware),
});

export type Action<T> = { type: string, payload: T }
export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;
