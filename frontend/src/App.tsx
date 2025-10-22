import { BrowserRouter, Routes, Route, Navigate, Link } from 'react-router-dom';
import { useAppDispatch, useAppSelector } from './hooks';

import './style/App.css'
import './style/login.css'
import './style/content.css'

import Login from './components/Login'; 
import Contacts from './components/Contacts'; 
import ContactDetail from './components/ContactDetail';
import Meetings from './components/Meetings';
import Contracts from './components/Contracts';

import { getAuthToken, logout } from './store/authSlice';
import Dashboard from './components/Dashboard';

export default function App() {
  const dispatch = useAppDispatch()
  const authToken = useAppSelector(getAuthToken)
  
  return (authToken ?
    <BrowserRouter>
      <div className="content">
        <nav>
          <h1>CONTRACT<br/>SYSTEM</h1>
          <Link to="/">Dashboard</Link>
          <Link to="/contacts">Contacts</Link>
          <Link to="/meetings">Meetings</Link>
          <Link to="/contracts">Sales</Link>
          <a href="#" onClick={() => dispatch(logout())}>Logout</a>
        </nav>

        <div className="container">
          <Routes>
            <Route path="/" element={<Dashboard/>} />
            <Route path="/contacts" element={<Contacts/>} />
            <Route path="/contacts/:id" element={<ContactDetail/>} />
            <Route path="/meetings" element={<Meetings/>} />
            <Route path="/contracts" element={<Contracts />} />
            <Route path="*" element={<Navigate to="/contacts" replace />} />
          </Routes>
        </div>
      </div>
    </BrowserRouter>
    : <Login />
  )
}
