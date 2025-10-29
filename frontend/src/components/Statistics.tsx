import { useGetUserStatisticsQuery } from "../services/api/userApi";

export default function Statistics()
{
      const { data: statistics, isLoading: isStatisticsLoading } = useGetUserStatisticsQuery(null);
    

    return <>{isStatisticsLoading ? <img src={"/src/assets/tube-spinner.svg"} height="100px" /> : <div className="white-box">
        <h3>Salesman statistics</h3>
        {statistics && <div className="table" style={{width: "150px"}}>
            <div className="row">
                <div className="table-label" style={{width:"100px"}}>Contacts</div>
                <div>{statistics.contacts}</div>
            </div>
            <div className="row">
                <div className="table-label" style={{width:"100px"}}>Calls</div>
                <div>{statistics.calls}</div>
            </div>
            <div className="row">
                <div className="table-label" style={{width:"100px"}}>Meetings</div>
                <div>{statistics.meetings}</div>
            </div>
        </div>}
    </div>}
    </>
}