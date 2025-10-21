import { useGetMeetingQuery } from '../services/api/meetingApi';

export default function Meetings(){
  const { data } = useGetMeetingQuery({});

  return <>
    <h2><div className="inner-content">Meetings</div></h2>
    <div className="inner-content">
      <br />
      <ul>{data?.map(m => <li key={m.id}>{m.title} ({new Date(m.startsAt).toLocaleString()})</li>)}</ul>
    </div>
  </>;
}
