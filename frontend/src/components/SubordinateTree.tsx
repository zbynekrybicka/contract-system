import { useEffect, type JSX } from "react"
import { useGetSalesmanTreeQuery } from "../services/api/userApi";
import { setFilteredSalesmanId } from "../store/salesmanFilterSlice";
import { useDispatch } from "react-redux";


export default function SubordinateTree() : JSX.Element
{
    const dispatch = useDispatch();
    const { data: salesmanList, isLoading: isSalesmanListLoading } = useGetSalesmanTreeQuery(null);
    useEffect(() => {
        dispatch(setFilteredSalesmanId(salesmanList ? salesmanList[0].id : null));
    }, [salesmanList]);

    /**
     * @param salesmen any[]
     * @returns JSX.Element
     */
    function tree(salesmen: any[]): JSX.Element 
    {
        return <ul>
            {salesmen.filter(salesman => salesman.isSalesman).map(salesman => 
                <li key={salesman.id} onClick={() => dispatch(setFilteredSalesmanId(salesman.id))}>
                    {salesman.name}
                    {salesman.subordinates && tree(salesman.subordinates)}
                </li>
            )}
        </ul>
    }


    return <div>{isSalesmanListLoading ? "Loading..." : salesmanList && tree(salesmanList)}</div>
}