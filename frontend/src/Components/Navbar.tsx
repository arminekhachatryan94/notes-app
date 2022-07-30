import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import Button from '@mui/material/Button';
import Notes from '../Pages/Notes';
import { Link, Route } from 'react-router-dom';

const Navbar = () => {
  return (
    <Box>
      <AppBar position="static" elevation={0}>
        <Toolbar style={{ background: 'white' }}>
          <Link to="/notes"><Button color="primary">Notes</Button></Link> 
          <Link to="/tags"><Button color="primary">Tags</Button></Link> 
        </Toolbar>
      </AppBar>
    </Box>
  )
}

export default Navbar;
