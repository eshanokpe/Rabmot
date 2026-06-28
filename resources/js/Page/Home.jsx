import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

export default function Home() {

 
return ( 
<> 
    <h2>Laravel 11 with vite-react</h2>
</> 
);
}

if (document.getElementById('apps')) {
ReactDOM.createRoot(document.getElementById('apps')).render(
<React.StrictMode>
    <Home />
</React.StrictMode>
); 
}
