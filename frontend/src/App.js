import React, { useState } from 'react';
import Cookies from 'js-cookie';
import './styles/App.css';
import Login from './components/Login';
import Logout from './components/Logout';
import Anagram from './components/Anagram';
import Dataset from './components/Dataset';
import { ToastContainer } from 'react-toastify';

const App = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(Cookies.get("isloggedin"));

  return (
    <div>
      <h1>ANAGRAMS</h1>
      {!isLoggedIn &&
        <Login setIsLoggedIn={setIsLoggedIn}/>
      }
      {isLoggedIn &&
        <div>
          <Logout setIsLoggedIn={setIsLoggedIn}/>
          <Dataset />
          <Anagram />
        </div>
      }
      <ToastContainer 
        hideProgressBar
        closeOnClick/>
    </div>
  );
  
}

export default App;
