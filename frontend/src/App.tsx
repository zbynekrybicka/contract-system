import { BrowserRouter, Routes, Route, Navigate, Link } from 'react-router-dom';
import Login from './pages/Login'; import Contacts from './pages/Contacts'; import Meetings from './pages/Meetings';
import { useAppDispatch, useAppSelector } from './hooks';
import { logout } from './features/auth/authSlice';

export default function App(){
  const token = useAppSelector(s => s.auth.token);
  const dispatch = useAppDispatch();

  return (!token ? <Login /> :
    <BrowserRouter>
      <nav><Link to="/contacts">Contacts</Link> | <Link to="/meetings">Meetings</Link> | <a href="#" onClick={e => {
        e.preventDefault()
        dispatch(logout());
      }}>Logout</a> </nav>
      <Routes>
        <Route path="/contacts" element={<Contacts/>} />
        <Route path="/meetings" element={<Meetings/>} />
        <Route path="*" element={<Navigate to="/contacts" replace />} />
      </Routes>
    </BrowserRouter>
  );
}
