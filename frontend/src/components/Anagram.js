import React, { useState } from 'react';
import { toast } from 'react-toastify';



const Anagram = () => {
    const [word, setWord] = useState("");
    const [anagrams, setAnagrams] = useState([]);
    const [fetched, setFetched] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();
        fetch('http://localhost/proovitoo/backend/api/anagram.php?word=' + word,
            {
                method: 'GET',
                credentials: 'include'
            })
            .then(response => (response.json())
                .then(data => {
                    switch (response.status) {
                        case 200:
                            setAnagrams(data.anagrams);
                            setWord(data.word);
                            setFetched(true);
                            break;
                        case 400:
                            toast.warning(data.error);
                            break;
                        case 500:
                            toast.error(data.error);
                            break;
                        default:
                            toast.error("Undefined");
                            break;
                    }
                }));

    }

    return (
        <div>
            <form onSubmit={e => handleSubmit(e)}>
                <label>
                    <input type="text" name="Word" placeholder="Word" value={word} onChange={e => { setWord(e.target.value); setFetched(false); }} />
                </label>
                <br />
                <input type="submit" value="Search for anagrams" />
            </form>
            {anagrams.length > 0 ? (
                <ul>
                    {anagrams.map(anagram => (
                        <li key={anagram}>{anagram}</li>
                    ))}
                </ul>
            ) : fetched && (<ul><li>word {word} has no anagrams</li></ul>)}
        </div>
    );
}

export default Anagram;
