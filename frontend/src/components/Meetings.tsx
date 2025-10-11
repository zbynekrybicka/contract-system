import { useGetMeetingsQuery } from '../services/api/meetingsApi';

export default function Meetings(){
  const { data } = useGetMeetingsQuery({});

  return <ul>{data?.map(m => <li key={m.id}>{m.title} ({new Date(m.startsAt).toLocaleString()})</li>)}</ul>;
}
