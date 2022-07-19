import React from 'react';

const Logout = (props) => {

  const handleSubmit = (e) => {
    fetch('http://localhost/proovitoo/backend/api/logout.php',
      {
        method: 'GET',
        credentials: 'include'
      }).then(props.setIsLoggedIn(false));

  }
  return (
    <form onSubmit={e => handleSubmit(e)}>
      <input type="submit" value="Logout" />
    </form>
  );
}

export default Logout;