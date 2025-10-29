import type { JSX } from "react";
import Statistics from "./Statistics";

export default function Dashboard(): JSX.Element {

  return (
    <div>
      <h2>
        <div className="inner-content">Dashboard</div>
      </h2>
      <div className="inner-content">
        <Statistics />
      </div>
    </div>
  )
}
