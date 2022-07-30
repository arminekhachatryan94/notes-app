import Box from '@mui/material/Box';
import Grid from '@mui/material/Grid';
import Card from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import Note from '../Interfaces/Note';
import moment from 'moment';

interface Props {
  note: Note;
}

const NoteComponent = ({ note }: Props) => {
  const dateFormat = () => {
    return moment(note.created_at).format('hh:mmA YYYY/MM/DD')
  }

  return (
    <Grid item xs={12}>
      <Card sx={{mt: 1 }}>
        <CardContent>
          <Typography sx={{ fontSize: 18 }} color='primary' component='div'>
            { note.title }
          </Typography>
          <Typography sx={{ fontSize: 12, textAlign: 'right' }} component='div'>
            Created: { dateFormat() }
          </Typography>
          <Typography sx={{ fontSize: 16 }} component='div'>
            { note.description }
          </Typography>

          <Container disableGutters sx={{ mt: 1 }}>
            { note.tags.map((tag, index) => (
            <Box
              component='div'
              sx={{
                display: 'inline',
                bgcolor: 'gray',
                p: 0.5,
                m: 0.5,
                color: 'white',
                border: '1px solid primary',
                fontSize: '12px',
              }}
              key={index}
              >
              { tag.name }
            </Box>
            ))}
          </Container>
        </CardContent>
      </Card>
    </Grid>
  )
}

export default NoteComponent;
