import React, { useState } from 'react';
import GiveRide from './GiveRide';
import TakeRide from './TakeRide';

function RideApp() {
  const [rides, setRides] = useState([]);

  const addRide = (ride) => {
    setRides([...rides, ride]);
  };

  return (
    <div>
      <GiveRide addRide={addRide} />
      <TakeRide rides={rides} />
    </div>
  );
}

export default RideApp;
