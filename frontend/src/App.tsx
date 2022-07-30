import './App.css';
import { Route, Routes } from "react-router-dom";

import Notes from './Pages/Notes';
import Tags from './Pages/Tags';
import Navbar from './Components/Navbar';

function App() {
  return (<>
      <Navbar />
      <Routes>
        <Route path="/" element={<Notes/>} />
        <Route path="/notes" element={<Notes/>} />
        <Route path="/tags" element={<Tags/>} />
      </Routes>
  </>);
}

export default App;
