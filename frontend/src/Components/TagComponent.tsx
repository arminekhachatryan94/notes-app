import { Button } from '@mui/material';
import Grid from '@mui/material/Grid';
import Tag from '../Interfaces/Tag';

interface Props {
  tag: Tag;
}

const TagComponent = ({ tag }: Props) => {
    return (<>
    <Grid container item>
        <Grid item xs={3} sm={2} md={1}>
            { tag.name }
        </Grid>
        <Grid item xs={3} sm={2} md={1}>
            <Button
                variant='outlined'
                color='primary'
                size='small'
                sx={{ ml: 3 }}
            >delete</Button>
        </Grid>
    </Grid>
    </>)
}

export default TagComponent;
