import Container from '@mui/material/Container';
import Grid from '@mui/material/Grid';
import React, { useEffect, useState } from 'react';
import NoteComponent from '../Components/NoteComponent';
import Note from '../Interfaces/Note';
import axios from 'axios';

const Notes = () => {
  const [notes, setNotes] = useState<Note[]>([]);

  useEffect(() => {
    axios.get('http://localhost:80/api/notes')
      .then(response => {
        setNotes(response.data.notes);
      }).catch(error => {
        console.log(error);
      });
  }, []);

  return (
    <Container sx={{ mt: 1, width: '100%' }}>
      <Grid container direction={"row"} sx={{ mt: 2 }}>
        {
          notes.map((note, index) => (<React.Fragment key={index}>
            <NoteComponent note={note} />
          </React.Fragment>))
        }
      </Grid>
    </Container>
  )
}

export default Notes;
