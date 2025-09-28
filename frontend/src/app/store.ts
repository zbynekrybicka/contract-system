import { configureStore } from '@reduxjs/toolkit';
import authReducer from '../features/auth/authSlice';
import { api } from '../services/api';

export const store = configureStore({
  reducer: { auth: authReducer, [api.reducerPath]: api.reducer },
  middleware: (gDM) => gDM().concat(api.middleware),
});
export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;
