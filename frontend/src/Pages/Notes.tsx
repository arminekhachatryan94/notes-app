import Container from '@mui/material/Container';
import Grid from '@mui/material/Grid';
import React, { useEffect, useState } from 'react';
import AddNoteButton from '../Components/AddNoteButton';
import NoteComponent from '../Components/NoteComponent';
import TagFilter from '../Components/TagFilter';
import Note from '../Interfaces/Note';
import Tag from '../Interfaces/Tag';
import axios from 'axios';

const Notes = () => {
  const [notes, setNotes] = useState<Note[]>([]);
  const [tags, setTags] = useState<Tag[]>([]);

  const addNoteToArray = (note: Note) => {
    setNotes(p => [
      note,
      ...p,
    ]);
  }

  const fetchNotes = (tagName: string) => {
    axios.get('http://localhost:80/api/notes', {
      params: {
        name: tagName
      }
    })
    .then(response => {
      setNotes(response.data.notes);
    }).catch(error => {
      console.log(error);
    });
  }

  const fetchTags = () => {
    axios.get('http://localhost:80/api/tags')
      .then(response => {
        setTags(response.data.tags);
      }).catch(error => {
        console.log(error);
      });
  }

  useEffect(() => {
    fetchNotes('');
    fetchTags();
  }, []);

  return (
    <Container sx={{ mt: 1, width: '100%' }}>
      <AddNoteButton tags={tags} addNoteToArray={addNoteToArray} />
      <TagFilter tags={tags} fetchNotes={fetchNotes} />
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
