import { useEffect, type JSX } from "react"
import { useGetSalesmanTreeQuery } from "../services/api/userApi";
import { setFilteredSalesmanId } from "../store/salesmanFilterSlice";
import { useDispatch } from "react-redux";


export default function SubordinateTree() : JSX.Element
{
    const dispatch = useDispatch();
    const { data: salesmanList, isLoading: isSalesmanListLoading } = useGetSalesmanTreeQuery(null);
    useEffect(() => {
        // console.log(salesmanList)
        dispatch(setFilteredSalesmanId(salesmanList ? salesmanList[0].id : null));
    }, [salesmanList]);


    const handleSelectSalesman = (salesman: any) => (event: React.MouseEvent<HTMLLIElement>) => {
        event.stopPropagation();
        dispatch(setFilteredSalesmanId(salesman.id))
    }

    /**
     * @param salesmen any[]
     * @returns JSX.Element
     */
    function tree(salesmen: any[]): JSX.Element 
    {
        return <ul>
            {salesmen.filter(salesman => salesman.isSalesman).map(salesman => 
                <li key={salesman.id} onClick={handleSelectSalesman(salesman)}>{salesman.id}
                    {salesman.name}
                    {salesman.subordinates && tree(salesman.subordinates)}
                </li>
            )}
        </ul>
    }


    return <div>{isSalesmanListLoading ? "Loading..." : salesmanList && tree(salesmanList)}</div>
}