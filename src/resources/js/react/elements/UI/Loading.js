import { useSelector } from 'react-redux';
import ReactLoading from "react-loading";

const Loading = (props) => {
    const spinner = useSelector(state => state.appReducer.loading);

    return spinner ? (<div style={{width: '100vw' , height: '100vh' }}><ReactLoading type={"spin"} style={{margin: '15% auto', height: '10%' , width: '10%' , fill: "#FFFFFF"}}  /></div>) : null;
}

export default Loading;
