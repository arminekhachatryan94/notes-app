import { 
    Box,
    InputLabel,
    MenuItem,
} from '@mui/material'
import Select from '@mui/material/Select';
import { useState } from 'react';
import Tag from '../Interfaces/Tag';

interface Props {
    tags: Tag[];
    fetchNotes: any;
}

const TagFilter = ({tags, fetchNotes}: Props) => {
    const [tagName, setTagName] = useState('');

    const handleTagChange = (event: any) => {
        setTagName(event.target.value);
        fetchNotes(event.target.value);
    };

    return (
        <>
        <Box sx={{ mt: 2, width: '100%'}}>
            <InputLabel id="tag-filter">Tag Filter</InputLabel>
            <Select
            label-id="tag-filter"
            label="Tag Filter"
            id="tag-filter"
            value={tagName}
            fullWidth
            defaultValue={''}
            onChange={handleTagChange}
            >
            <MenuItem
                key={0}
                value={''}
            >
                <em>None</em>
            </MenuItem>
            {tags.map((tag, index) => (
                <MenuItem
                key={index+1}
                value={tag.name}
                >
                {tag.name}
                </MenuItem>
            ))}
            </Select>
        </Box>
        </>
    )
}

export default TagFilter;
