import { BrowserRouter, Routes, Route, Navigate, Link } from 'react-router-dom';
import { useAppDispatch, useAppSelector } from './hooks';

import Login from './components/Login'; 
import Contacts from './components/Contacts'; 
import Meetings from './components/Meetings';

import { getAuthToken, logout } from './store/authSlice';

export default function App() {
  const dispatch = useAppDispatch()
  const authToken = useAppSelector(getAuthToken)
  
  return (authToken ?
    <BrowserRouter>

      <nav>
        <Link to="/contacts">Contacts</Link> | 
        <Link to="/meetings">Meetings</Link> | 
        <a href="#" onClick={() => dispatch(logout())}>Logout</a>
      </nav>

      <Routes>
        <Route path="/contacts" element={<Contacts/>} />
        <Route path="/meetings" element={<Meetings/>} />
        <Route path="*" element={<Navigate to="/contacts" replace />} />
      </Routes>

    </BrowserRouter>
    : <Login />
  )
}
