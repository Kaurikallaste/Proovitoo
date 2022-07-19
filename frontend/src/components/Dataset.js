import React, { useState } from 'react';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.min.css';

const Dataset = () => {
    const [selectedFile, setSelectedFile] = useState();

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('File', selectedFile);

        toast("Uploading dataset");

        fetch(process.env.REACT_APP_BACKEND_URL + '/dataset.php',
            {
                method: 'POST',
                credentials: 'include',
                body: formData,
            })
            .then(response => (response.json())
                .then(data => {
                    switch (response.status) {
                        case 200:
                            toast.success(data.message);
                            break;
                        case 400:
                            toast.warning(data.message);
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

    const changeHandler = (e) => {
        setSelectedFile(e.target.files[0]);
    };

    return (
        <form onSubmit={e => handleSubmit(e)}>
            <input type="file" name="file" onChange={changeHandler} />
            <input type="submit" value="Upload Dataset" />
            <p className="note">Supported filetypes: txt</p>
        </form>
    );
}

export default Dataset;
