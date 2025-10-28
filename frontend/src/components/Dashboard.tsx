import Statistics from "./Statistics";

export default function Dashboard() {

  return (
    <div>
      <h2>
        <div className="inner-content">Dashboard</div>
      </h2>
      <div className="inner-content routes">
        <Statistics />
      </div>
    </div>
  )
}
