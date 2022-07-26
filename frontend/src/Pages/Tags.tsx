import Container from '@mui/material/Container';
import Grid from '@mui/material/Grid';
import React, { useEffect, useState } from 'react';
import AddTagButton from '../Components/AddTagButton';
import TagComponent from '../Components/TagComponent';
import Tag from '../Interfaces/Tag';
import axios from 'axios';
import { Box } from '@mui/material';

const Tags = () => {
  const [tags, setTags] = useState<Tag[]>([]);

  const addTagToArray = (tag: Tag) => {
    setTags(p => [
      ...p,
      tag
    ]);
  }

  const removeTagFromArray = (tag: Tag) => {
    const newTags = tags.filter(tagEl => {return tagEl.id !== tag.id});
    setTags(newTags);
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
    fetchTags();
  }, []);

  return (
    <Container sx={{ mt: 1, width: '100%' }}>
      <AddTagButton tags={tags} addTagToArray={addTagToArray} />
      <Box sx={{ flexGrow: 1 }}>
      <Grid container direction={"row"} sx={{ mt: 2 }} spacing={0.5}>
        {
          tags.map((tag, index) => (<React.Fragment key={index}>
            <TagComponent tag={tag} removeTagFromArray={removeTagFromArray} />
          </React.Fragment>))
        }
      </Grid>
      </Box>
    </Container>
  )
}

export default Tags;
