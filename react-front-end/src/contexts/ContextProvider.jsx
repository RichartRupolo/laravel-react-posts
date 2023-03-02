import { useContext } from "react";
import { useState } from "react";
import { createContext } from "react";

const StateContext = createContext({
  currentUser: {},
  userToken: null,
  posts: [],
  questionTypes: [],
  toast: {
    message: null,
    show: false,
  },
  setCurrentUser: () => {},
  setUserToken: () => {},
});

const tmpPosts = []
export const ContextProvider = ({ children }) => {
  const [currentUser, setCurrentUser] = useState({});
  const [userToken, _setUserToken] = useState(localStorage.getItem('TOKEN') || '');
  const [posts, setPosts] = useState(tmpPosts)
  const [toast, setToast] = useState({message: '', show: false})

  const setUserToken = (token) => {
    if (token) {
      localStorage.setItem('TOKEN', token)
    } else {
      localStorage.removeItem('TOKEN')
    }
    _setUserToken(token);
  }

  const showToast = (message) => {
    setToast({ message, show: true })
    setTimeout(() => {
      setToast({message: '', show: false})
    }, 5000)
  }

  return (
    <StateContext.Provider
      value={{
        currentUser,
        setCurrentUser,
        userToken,
        setUserToken,
        posts,
        toast,
        showToast
      }}
    >
      {children}
    </StateContext.Provider>
  );
};

export const useStateContext = () => useContext(StateContext);