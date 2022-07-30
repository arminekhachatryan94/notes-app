import { 
    Button,
    FormControl,
    Grid,
    TextField
} from '@mui/material'
import axios from 'axios';
import { useState } from 'react';
import Tag from '../Interfaces/Tag';

interface Props {
  tags: Tag[],
  addTagToArray: any;
}

const AddTagButton = (props: Props) => {
  const [tagName, setTagName] = useState('');
  const [errorMessage, setErrorMessage] = useState('');

  const wrapAddTagToArray = (tag: Tag) => {
    props.addTagToArray(tag);
  }

  const handleChange = (e: any) => {
    setErrorMessage('');
    setTagName(e.target.value);
  }

  const handleSave = () => {
    axios.post('http://localhost:80/api/tags', {
      'name': tagName,
    })
      .then(response => {
        console.log(response.data.tag);
        const responseTag = response.data.tag
        wrapAddTagToArray(responseTag);
        setTagName('');
      }).catch(error => {
        if(error.response.data.errors.name) {
          setErrorMessage(error.response.data.errors.name);
        }
      });
  }

  return (
    <Grid container spacing={2}>
      <Grid item xs={4}>
          <TextField
            type='text'
            label="Type in a tag name..."
            required
            fullWidth
            value={tagName}
            onChange={handleChange}
            error={errorMessage !== ''}
            helperText={errorMessage}
          />
        </Grid>
        <Grid item xs={4}>
          <Button
            variant='contained'
            color={'primary'}
            size='large'
            onClick={handleSave}
          >
            Add Tag
          </Button>
      </Grid>
    </Grid>
  )
}

export default AddTagButton;
