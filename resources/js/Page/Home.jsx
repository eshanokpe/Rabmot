import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

export default function Home() {

 
return ( 
<> 
    <h2>Laravel 11 with vite-react</h2>
</>
);
}

if (document.getElementById('app')) {
ReactDOM.createRoot(document.getElementById('app')).render(
<React.StrictMode>
    <Home />
</React.StrictMode>
);
}
