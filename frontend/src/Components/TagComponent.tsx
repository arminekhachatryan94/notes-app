import { Button, FormHelperText } from '@mui/material';
import Grid from '@mui/material/Grid';
import axios from 'axios';
import { useState } from 'react';
import Tag from '../Interfaces/Tag';

interface Props {
  tag: Tag;
  removeTagFromArray: any;
}

const TagComponent = ({ tag, removeTagFromArray }: Props) => {
    const [error, setError] = useState('');

    const handleDelete = (tag: Tag) => {
        setError('');
        axios.delete('http://localhost:80/api/tags/' + tag.id)
            .then(response => {
                removeTagFromArray(tag);
            }).catch(error => {
                setError('Error deleting tag.');
            });
    }

    return (<>
    <Grid container item>
        <Grid item xs={3} sm={2} md={1}>
            { tag.name }
        </Grid>
        <Grid item xs={3} sm={2} md={1}>
            <Button
                onClick={() => handleDelete(tag)}
                variant='outlined'
                color='primary'
                size='small'
                sx={{ ml: 3 }}
            >delete</Button>
        </Grid>
    </Grid>
    {error !== '' && <FormHelperText error>{error}</FormHelperText>}
    </>)
}

export default TagComponent;
