import React, { useState } from 'react';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.min.css';

const Login = (props) => {
  const [name, setName] = useState("");
  const [password, setPassword] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("name", name);
    formData.append("password", password);

    fetch(process.env.REACT_APP_BACKEND_URL + '/auth.php',
      {
        method: 'POST',
        credentials: 'include',
        body: formData,
      })
      .then(response => (response.json())
        .then(data => {
          switch (response.status) {
            case 200:
              props.setIsLoggedIn(true);
              break;
            case 401:
              toast.error(data.message);
              break;
            case 500:
              toast.error(data.message);
              break;
            default:
              toast.error("Undefined");
              break;
          }
        }));
  }
  return (
    <form onSubmit={e => handleSubmit(e)}>
      <label>
        <input type="text" name="name" placeholder="Username" value={name} onChange={e => setName(e.target.value)} />
      </label>
      <br />
      <label>
        <input type="password" name="name" placeholder="Password" value={password} onChange={e => setPassword(e.target.value)} />
      </label>
      <br />
      <input type="submit" value="Login" />
    </form>
  );
}

export default Login;
