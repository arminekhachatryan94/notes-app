import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import Button from '@mui/material/Button';
import { Link, Route, useLocation } from 'react-router-dom';
import { useEffect, useState } from 'react';

const Navbar = () => {
  const location = useLocation(); // once ready it returns the 'window.location' object
  const [subDomain, setSubDomain] = useState('');

  useEffect(() => {
    setSubDomain(location.pathname);
  }, [location]);

  return (
    <Box>
      <AppBar position="static" elevation={0}>
        <Toolbar style={{ background: 'white' }}>
          <Link to="/notes">
            <Button
              color="primary"
              sx={{ 
                fontWeight: subDomain === '/notes' ? 'bold' : 'lighter',
                fontSize: '18px',
                fontFamily: 'Times New Roman", Times, serif',
              }}>
              Notes
            </Button>
          </Link> 
          <Link to="/tags">
            <Button
              color="primary"
              sx={{ 
                fontWeight: subDomain === '/tags' ? 'bold' : 'lighter',
                fontSize: '18px',
                fontFamily: 'Times New Roman", Times, serif',
              }}>
              Tags
            </Button>
          </Link> 
        </Toolbar>
      </AppBar>
    </Box>
  )
}

export default Navbar;
