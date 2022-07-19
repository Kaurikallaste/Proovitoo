import React from 'react';

const Logout = (props) => {

  const handleSubmit = (e) => {
    fetch(process.env.REACT_APP_BACKEND_URL + '/logout.php',
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