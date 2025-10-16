import { useGetMeetingQuery } from '../services/api/meetingApi';

export default function Meetings(){
  const { data } = useGetMeetingQuery({});

  return <ul>{data?.map(m => <li key={m.id}>{m.title} ({new Date(m.startsAt).toLocaleString()})</li>)}</ul>;
}
