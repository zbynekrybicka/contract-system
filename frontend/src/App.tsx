import { BrowserRouter, Routes, Route, Navigate, Link } from 'react-router-dom';
import Login from './pages/Login'; import Contacts from './pages/Contacts'; import Meetings from './pages/Meetings';
import { useAppSelector } from './hooks';

function Private({children}:{children:JSX.Element}) {
  const token = useAppSelector(s=>s.auth.token);
  return token ? children : <Navigate to="/login" replace />;
}
export default function App(){
  return (
    <BrowserRouter>
      <nav><Link to="/contacts">Contacts</Link> | <Link to="/meetings">Meetings</Link></nav>
      <Routes>
        <Route path="/login" element={<Login/>} />
        <Route path="/contacts" element={<Private><Contacts/></Private>} />
        <Route path="/meetings" element={<Private><Meetings/></Private>} />
        <Route path="*" element={<Navigate to="/contacts" replace />} />
      </Routes>
    </BrowserRouter>
  );
}
