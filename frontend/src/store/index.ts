import { combineReducers, configureStore } from '@reduxjs/toolkit';
import auth from './authSlice';
import { api } from '../services/api';

export const rootReducer = combineReducers({
  /**
   * Here register new reducers
   */
  auth,
  [api.reducerPath]: api.reducer,
});

export const store = configureStore({
  reducer: rootReducer,
  middleware: (gDM) => gDM().concat(api.middleware),
});

export type RootState = ReturnType<typeof rootReducer>;
export type Action<T> = { type: string, payload: T }
export type AppDispatch = typeof store.dispatch;
