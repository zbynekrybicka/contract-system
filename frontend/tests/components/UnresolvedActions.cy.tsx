import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import UnresolvedActions from '../../src/components/UnresolvedActions'


describe('UnresolvedActions.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><UnresolvedActions /></Provider>)
  })
})