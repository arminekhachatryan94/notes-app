import { 
    Box,
    Button,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    Divider,
    FormControl,
    FormHelperText,
    InputLabel,
    List,
    ListItem,
    MenuItem,
    Paper,
    TextField
} from '@mui/material'
import Select from '@mui/material/Select';
import axios from 'axios';
import { useState } from 'react';
import Note from '../Interfaces/Note';
import Tag from '../Interfaces/Tag';

interface Props {
  tags: Tag[];
  addNoteToArray: any;
}

const AddNoteButton = (props: Props) => {
  const [open, setOpen] = useState(false);
  const [note, setNote] = useState({
      title: '',
      description: '',
      user_id: 1,
  });
  const [tagIds, setTagIds] = useState<number[]>([]);
  const [errors, setErrors] = useState({
    title: '',
    description: '',
    tag_ids: '',
  });

  const wrapAddNoteToArray = (note: Note) => {
    props.addNoteToArray(note);
  }

  const clearErrors = () => {
    setErrors({
      title: '',
      description: '',
      tag_ids: '',
    });
  }

  const handleCancel = () => {
    clearErrors();
    setOpen(false);
  }

  const handleTagChange = (event: any) => {
    clearErrors();
    setTagIds(event.target.value);
  };

  const handleSave = () => {
    axios.post('http://localhost:80/api/notes', {
      'title': note.title,
      'description': note.description,
      'tag_ids': tagIds,
    })
      .then(response => {
        const responseNote = response.data.note
        wrapAddNoteToArray(responseNote);
        setOpen(false);
      }).catch(error => {
        const responseErrors = error.response.data.errors;
        if(responseErrors.title) {
          setErrors(errors => ({
            ...errors,
            ...{'title': responseErrors.title}
          }));
        }
        if(responseErrors.description) {
          setErrors(errors => ({
            ...errors,
            ...{'description': responseErrors.description}
          }));
        }
        if(responseErrors.tag_ids) {
          setErrors(errors => ({
            ...errors,
            ...{'tag_ids': responseErrors.tag_ids}
          }));
        }
      });
  }

  return (
    <>
      <Button
        variant='contained'
        color={'primary'}
        onClick={() => setOpen(true)}
      >
        Add Note
      </Button>
      <Dialog
        open={open}
        fullWidth
        onClose={handleCancel}
      >
          <DialogTitle color="primary">Add Note</DialogTitle>
          <DialogContent>
            <InputLabel id='title'>Title</InputLabel>
            <TextField
              id='title'
              type='text'
              fullWidth
              required
              value={note.title}
              onChange={e => {
                clearErrors();
                setNote(note => ({
                  ...note,
                  ...{'title': e.target.value}
                }))
              }}
              error={errors.title !== ''}
              helperText={errors.title}
            />
            <Box sx={{ m: 2 }} />
            <InputLabel id='description'>Description</InputLabel>
            <TextField
                id='description'
                type='text'
                fullWidth
                required
                value={note.description}
                onChange={e => {
                  clearErrors();
                  setNote(note => ({
                    ...note,
                    ...{'description': e.target.value}
                  }))
                }}
                error={errors.description !== ''}
                helperText={errors.description}
              />
            <Box sx={{ m: 2 }} />
            <InputLabel id='tags'>Tags</InputLabel>
            <Select
              labelId="tags-label"
              id="tags"
              multiple={true}
              defaultValue={[]}
              value={tagIds}
              fullWidth
              onChange={handleTagChange}
              error={errors.tag_ids !== ''}
            >
              {props.tags.map((tag, index) => (
                <MenuItem
                  key={index}
                  value={tag.id}
                >
                  {tag.name}
                </MenuItem>
              ))}
            </Select>
            {errors.tag_ids !== '' && <FormHelperText error>{errors.tag_ids}</FormHelperText>}
          </DialogContent>
          <DialogActions>
            <Button onClick={handleCancel}>Cancel</Button>
            <Button onClick={handleSave}>Save</Button>
          </DialogActions>
      </Dialog>
    </>
  )
}

export default AddNoteButton;
